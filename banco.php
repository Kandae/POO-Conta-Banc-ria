<?php
class ContaBancaria{
    public string $numeroConta;
    public string $nomeTitular;
    public string $cpf;
    public string $agencia;
    public string $tipoConta;
    public float $saldo;
    public string $situacao;



    public function __construct(string $numeroConta, string $nomeTitular, string $cpf, string $agencia,string $tipoConta, float $saldo, string $situacao)
    {
            $this->numeroConta = $numeroConta;
            $this->nomeTitular = $nomeTitular;
            $this->cpf = $cpf;
            $this->agencia = $agencia;
            $this->tipoConta = $tipoConta;
            $this->saldo = $saldo;
            $this->situacao = "Ativa";

    }
    
    public function apresentarDados() : void {
        echo "=====================================</br>\n" ;
        echo "Banco Horizonte\n";
        echo "Conta: " . $this->numeroConta . "</br>\n";
        echo "Titular: " . $this->nomeTitular . "</br>\n";
        echo "CPF: " . $this->cpf . "</br>\n";
        echo "Agência: " . $this->agencia . "</br>\n";
        echo "Tipo: " . $this->tipoConta . "</br>\n";
        echo "Saldo: R$ " . number_format($this->saldo, 2, ',', '.') . "</br>\n";
        echo "Situação: " . $this->situacao . "</br>\n";
        echo "====================================</br>\n";
    }

    public function depositar(float $valor) : void {
        if ($this->situacao == "Bloqueada") {
            echo "Erro: Não é possível realizar depósitos em uma conta bloqueada.\n";
            return;
        }
        if ($valor <= 0) {
            echo "Erro: O valor do depósito deve ser maior que zero.\n";
            return;
        }
        $this->saldo += $valor;
        echo "Depósito de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso.\n";
        echo "Novo saldo: R$ " . number_format($this->saldo, 2, ',', '.') . "\n";
    }

    public function sacar(float $valor) : void {
        if ($this->situacao === "Bloqueada") {
            echo "Erro: Não é possível realizar saques em uma conta bloqueada.\n";
            return;
        }
        if ($valor <= 0) {
            echo "Erro: O valor do saque deve ser maior que zero.\n";
            return;
        }
        if ($valor > $this->saldo) {
            echo "Erro: Saldo insuficiente para realizar o saque.\n";
            return;
        }
        $this->saldo -= $valor;
        echo "Saque de R$ " . number_format($valor, 2, ',', '.') . " realizado com sucesso.\n";
        echo "Novo saldo: R$ " . number_format($this->saldo, 2, ',', '.') . "\n";
    }

    public function consultarSaldo() : void {
        echo "Saldo atual: R$ " . $this->numeroConta . ": R$" .number_format($this->saldo, 2, ',', '.') . "\n";
    }


    public function alterarTitular(string $novoNome): void{
        if (trim($novoNome) === ""){
            echo "Erro: O nome do titular não pode ser vazio.\n";
            return;
        }

        $nomeAntigo = $this->nomeTitular;
        $this->nomeTitular = $novoNome;
        echo "Titular aletrado com sucesso de '{$nomeAntigo}' para '{$this->nomeTitular}'.\n";

    }
    
    




    
    //parte do keven
    public function bloquear_conta() : void
    {
        if ($this->situacao === "Bloqueada") {
            echo "A conta já está bloqueada.\n";
        }else {
             $this->situacao = "Bloqueada";
            echo "A conta foi bloqueada com sucesso.\n";
        }
       
    }
    public function desbloquear_conta(): void
    {
        if ($this->situacao === "Ativa") {
            echo "A conta já está ativa.\n";
        }else {
             $this->situacao = "Ativa";
            echo "A conta foi desbloqueada com sucesso.\n";
        }
       
    }
    

    public function transferir(float $saldo, float $valor, string $numeroConta, string $nomeTitular): void
    {
        if($this->situacao === "Bloqueada"){
            echo "Erro: Não é possível realizar transferências em uma conta bloqueada.</br>\n";
            return;
        }

        if($this->saldo < $valor){
            echo "Erro: Saldo insuficiente para realizar a transferência.</br>\n";
            return;
        }
        if($valor <=0 ){
            echo "Erro: o valor deve ser maior que zero.</br>\n";
            return;
        }

        $this ->saldo -= $valor;
        
        echo "Transferência de R$ " . number_format($valor, 2, ',', '.') . " realizada com sucesso para a conta {$numeroConta} - Titular: {$nomeTitular}.</br>\n";
    }
    
    
}

$conta1 = new ContaBancaria ("12345-6", "João Silva", "123.456.789-00", "001", "Corrente", 1000.00, "Ativa");
$conta2 = new ContaBancaria ("98765-4", "Maria Souza", "987.654.321-00", "002", "Poupança", 500.00, "Ativa");
$conta3 = new ContaBancaria ("54321-0", "Carlos Oliveira", "456.789.123-00", "003", "Corrente", 2000.00, "Ativa");


$conta1->apresentarDados();
$conta2->apresentarDados();
$conta3->apresentarDados();
$conta1->transferir(1000.00, 200.00, $conta2->numeroConta, $conta2->nomeTitular);
$conta2->transferir(1000.00, 200.00, $conta3->numeroConta, $conta3->nomeTitular)    ;
$conta1->apresentarDados();
$conta2->apresentarDados();
$conta3->bloquear_conta();
$conta3->apresentarDados();