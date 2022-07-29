# Exercício 1 - Múltiplos de 3 ou 5

### Desenvolva um sistema que responda às seguintes dúvidas:

- Qual é o valor da soma de todos os números múltiplos de 3 ou 5 de números naturais abaixo de 1000?
- Qual é o valor da soma de todos os números múltiplos de 3 e 5 de números naturais abaixo  de 1000?
- Qual é o valor da soma de todos os números múltiplos de (3 ou 5) e 7 de números naturais  abaixo de 1000? 

### Definition of Done

- Uma solução completamente testada, de preferência com testes para cada passo essencial para a checagem do resultado.
- O mínimo esperado é que tenham 3 testes, uma para cada pergunta, além de outros testes validando os algoritmos usados para se chegar na solução final.

-------------------------------------------------------

# Exercício 2 - Números Felizes

### Os números felizes são definidos pelo seguinte procedimento:
- Começando com qualquer número inteiro positivo, o número é substituído pela soma dos
  quadrados dos seus dígitos.
- Repete-se esse processo até que o número seja igual a 1.
- Um número não é feliz quando, em seu processo de cálculo, em algum momento ele entra
  em loop, ou seja, ele passe por um número que ele já passou anteriormente (não é possível
  determinar um número específico que ele sempre irá passar).
- Faça um programa que, dado um número natural qualquer, determine se é um número feliz.

### Definition of Done

- Um trecho de código onde é possível invocar um método checando se o número é feliz ou
não, e o sistema consiga responder.
- A solução final deve ser quebrada em diversas etapas, passos que precisam ser executados
  para se chegar na solução final, e cada uma dessas etapas devem estar cobertas com
  testes automatizados.

----------------------------------------------

# Exercício 3 - Palavras em números

### Neste problema, dado uma palavra composta somente por letras [a-zA-Z], cada letra possui um valor específico, ‘a’ vale 1, ‘b’ vale 2 e assim por diante, até a letra ‘z’ que vale 26.
### Do mesmo modo ‘A’ vale 27, ‘B’ vale 28, até a letra ‘Z’ que vale 52.

- O valor da palavra será a soma total dos valores de todas as letras da palavra.
- Você precisa definir se cada palavra em um conjunto de palavras é: PRIMA, MULTIPLA DE 3 ou 5, FELIZ;
- Qualquer caractere na palavra que não seja uma letra deve ser desconsiderado.

### Definition of Done

- Um sistema que, quando executado, transforme uma palavra em um número, seguindo a lógica acima, e responda às três questões: se é prima, feliz e múltipla de 3 ou 5.
- Não há a necessidade de ter interação com o usuário para requisitar a palavra.
- É esperado que as soluções anteriores sejam re-usadas, e cada novo componente criado seja coberto com testes automatizados.
----------------------------------------------


# Exercício 4 - Calculo de frete

### Em todos os e-commerces, o usuário pode criar um carrinho de compras, adicionar um produto e calcular o valor do frete para a entrega.
### O valor do frete é calculado a partir do CEP do usuário (destinatário), e geralmente é provido pelos serviços de fretamento (correios ou particular), muitas vezes sendo invocado uma API que, dado o CEP (dentre outros dados), traz o valor do frete.
### Desenvolva um sistema simplificado do carrinho, com os seguintes requisitos:

- Um produto possui um nome e um valor;
- Um carrinho recebe um conjunto de produtos e a quantidade de itens de cada produto;
- Um carrinho pertence à um usuário, que tem nome e seu endereço de entrega representado por um CEP;
- Um serviço que recebe o carrinho, e retorna o valor final para o usuário;

### Esse serviço

- Faz a soma total de valores de todos os produtos do carrinho;
- Caso o valor seja < $100,00, o sistema requisita para um serviço externo o valor do frete de acordo com o CEP do dono do carrinho;
- Retorna o valor final do carrinho (com ou sem frete);
