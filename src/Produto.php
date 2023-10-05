<?php
namespace ExemploCrudPoo;
use Exception, PDO;

final class Produto {
    
	

    private int $id;
    private string $nome;
    private string $descricao;
    private float $preco;
    private int $quantidade;
    private int $fabricante_id;
    
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }


    public function lerProdutos():array {
        $sql = "SELECT 
                    produtos.id,
                    produtos.nome AS produto,
                    produtos.preco,
                    produtos.quantidade,
                    fabricantes.nome AS fabricante,
                    (produtos.preco * produtos.quantidade) AS total
                FROM produtos INNER JOIN fabricantes
                ON produtos.fabricante_id = fabricantes.id
                ORDER BY produto";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar produtos: ".$erro->getMessage());
        }
        
        return $resultado;
    }


    public function inserirFabricante():void {
        $sql = "INSERT INTO fabricantes(nome) VALUES(:nome)";
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: ".$erro->getMessage());
        }
    
    }


    public function inserirProduto():void {
    
        $sql = "INSERT INTO produtos(
            nome, preco, quantidade, descricao, fabricante_id
        ) VALUES(
            :nome, :preco, :quantidade, :descricao, :fabricanteId
        )";    
    
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":preco", $this->preco, PDO::PARAM_STR);
            $consulta->bindValue(":quantidade", $this->quantidade, PDO::PARAM_INT);
            $consulta->bindValue(":descricao", $this->descricao, PDO::PARAM_STR);
            $consulta->bindValue(":fabricanteId", $this->fabricante_id, PDO::PARAM_INT);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: ".$erro->getMessage());
        }
    }











    // public function lerUmFabricante():array {
    //     $sql = "SELECT * FROM fabricantes WHERE id = :id";
    
    //     try {
    //         $consulta = $this->conexao->prepare($sql);
    //         $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
    //         $consulta->execute();
    //         $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    //     } catch (Exception $erro) {
    //         die("Erro ao carregar: ".$erro->getMessage());
    //     }
    
    //     return $resultado;
    // } 


    // public function atualizarFabricante():void {
    //     $sql = "UPDATE fabricantes SET nome = :nome WHERE id = :id";
        
    //     try {
    //         $consulta = $this->conexao->prepare($sql);
    //         $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
    //         $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
    //         $consulta->execute();
    //     } catch (Exception $erro) {
    //         die("Erro ao atualizar: ".$erro->getMessage());
    //     }
    // }

    // public function excluirFabricante():void {
    //     $sql = "DELETE FROM fabricantes WHERE id = :id";
    //     try {
    //         $consulta = $this->conexao->prepare($sql);
    //         $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
    //         $consulta->execute();
    //     } catch (Exception $erro) {
    //         die("Erro ao excluir: ".$erro->getMessage());
    //     }
    // } 






    // ============= GETTERS SETTERS ID ==============
    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): self {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }

    // ============= GETTERS SETTERS NOME ===============
    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): self
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    // =========== GETTERS SETTERS DESCRICAO =============
    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): self {
        $this->descricao = filter_var($descricao, FILTER_SANITIZE_SPECIAL_CHARS);
        return $this;
    }


    // ============= GETTERS SETTERS PRECO ===============
    public function getPreco(): float {
        return $this->preco;
    }

    public function setPreco(float $preco): self {
        $this->preco = filter_var($preco, FILTER_SANITIZE_NUMBER_FLOAT);
        return $this;
    }


    // ========== GETTERS SETTERS QUANTIDADE ============
    public function getQuantidade(): int {
        return $this->quantidade;
    }

    public function setQuantidade(int $quantidade): self {
        $this->quantidade = filter_var($quantidade, FILTER_SANITIZE_NUMBER_INT);
        return $this;
    }


    // ========= GETTERS SETTERS FABRICANTE ID ==========
    public function getFabricanteId(): int {
        return $this->fabricante_id;
    }

    public function setFabricanteId(int $fabricante_id): self {
        $this->fabricante_id = filter_var($fabricante_id, FILTER_SANITIZE_NUMBER_INT);

        return $this;
    }
}