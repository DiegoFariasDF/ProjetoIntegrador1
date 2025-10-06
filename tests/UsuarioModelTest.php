<?php

use PHPUnit\Framework\TestCase;

// Ajuste o caminho conforme a estrutura do seu projeto
require_once __DIR__ . '/../app/model/UsuarioModel.php';

class UsuarioModelTest extends TestCase
{
    private $usuarioModel;
    private $conexao;
    private $testUsuario = null; // Usuário de teste

    // Executado antes de CADA teste
    protected function setUp(): void
    {
        $this->usuarioModel = new UsuarioModel();
        $this->conexao = (new Database())->getConnection();

        // Criar um usuário de teste no DB
        $nome = "Usuario Teste";
        $permissao = 1;
        $usuario = "teste_" . uniqid(); // garante valor único
        $senha = "senhaSegura123";
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $stmt = $this->conexao->prepare("INSERT INTO usuarios (nome, permissao, usuario, senha) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siss", $nome, $permissao, $usuario, $senhaHash);
        $stmt->execute();

        $this->testUsuario = [
            'id' => $stmt->insert_id,
            'usuario' => $usuario,
            'senha' => $senha
        ];

        $stmt->close();
    }

    // Executado depois de CADA teste
    protected function tearDown(): void
    {
        if ($this->testUsuario) {
            $stmt = $this->conexao->prepare("DELETE FROM usuarios WHERE id = ?");
            $stmt->bind_param("i", $this->testUsuario['id']);
            $stmt->execute();
            $stmt->close();
            $this->testUsuario = null;
        }
        $this->usuarioModel = null;
        $this->conexao->close();
    }

    // --- Teste de autenticação com credenciais corretas ---
    public function testAutenticarUsuarioComCredenciaisCorretas()
    {
        $resultado = $this->usuarioModel->autenticarUsuario(
            $this->testUsuario['usuario'],
            $this->testUsuario['senha']
        );

        $this->assertIsArray($resultado, "A autenticação bem-sucedida deve retornar um array de dados.");
        $this->assertArrayHasKey('usuario', $resultado, "O array de resultado deve ter a chave 'usuario'.");
        $this->assertEquals($this->testUsuario['usuario'], $resultado['usuario'], "O usuário retornado deve ser o mesmo que o de login.");
    }

    // --- Teste de autenticação com senha incorreta ---
    public function testAutenticarUsuarioComSenhaIncorreta()
    {
        $resultado = $this->usuarioModel->autenticarUsuario(
            $this->testUsuario['usuario'],
            'senhaErrada123'
        );

        $this->assertFalse($resultado, "A autenticação com senha incorreta deve retornar false.");
    }

    // --- Teste de autenticação com usuário inexistente ---
    public function testAutenticarUsuarioComUsuarioInexistente()
    {
        $usuarioInexistente = "nao_existe_" . uniqid();
        $resultado = $this->usuarioModel->autenticarUsuario($usuarioInexistente, 'qualquer_senha');

        $this->assertFalse($resultado, "A autenticação com usuário inexistente deve retornar false.");
    }

    // --- Teste de adição de usuário ---
    public function testAdicionarUsuarioDeveRetornarTrueEmCasoDeSucesso()
    {
        $nome = "Usuario Adicional";
        $permissao = 1;
        $usuario = "usuario_add_" . uniqid();
        $senha = "senhaAdd123";

        $resultado = $this->usuarioModel->adicionarUsuario($nome, $permissao, $usuario, $senha);

        $this->assertTrue($resultado, "O método adicionarUsuario deve retornar true ao adicionar com sucesso.");

        // Limpeza: deletar o usuário criado
        $stmt = $this->conexao->prepare("DELETE FROM usuarios WHERE usuario = ?");
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $stmt->close();
    }
}
