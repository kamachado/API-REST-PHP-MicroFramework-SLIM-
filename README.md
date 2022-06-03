## Primeiros passos do programa
•	Quando você iniciar o projeto é preciso criar no banco de dados as seguintes tabelas utilizando o arquivo SQLQuery projetoDB.sql:
o	person 
o	department 
o	rel_Employee_department 
•	Ao rodar o arquivo SQLQuery projetoDB.sql já terá uma gama de cadastros em seu banco de dados.
## Controllers recebe a solicitação do usuário pela URL e manda para a service;
BaseController possui os códigos básicos utilizados nas Controllers; 
MicroFramework Slim : É um MicroFramework que realiza a interpretação das rotas recebidas pelo Browser, essa rotas vão gerar comandos que serão recebidos pelas Controllers. 
## Endpoints do projeto 

Todos métodos GET
- GET http://localhost:8080/turma - Retorna as turmas cadastradas.
- GET http://localhost:8081/person - Retorna todas as pessoas cadastradas;

- GET http://localhost:8081/person/{id} - Retorna a pessoa cadastrada conforme o Id informado;

-GET http://localhost:8081/department Retorna todos os departamentos cadastrados;

- GET http://localhost:8081/department/{id} - Retorna o departamento  cadastrado conforme o Id informado;


Todos métodos Post
- POST http://localhost:8081/person- Cadastra uma nova pessoa, para isso deve receber um Json.

- POST http://localhost:8081/department- Cadastra um novo departamneto, para isso deve receber um Json.

Todos métodos Put
- PUT http://localhost:8081/person/{id}- Atualiza uma pessoa cadastrada conforme Id informado, para isso deve receber um Json com as informações que deseja atualizar.

- PUT http://localhost:8081/department/{id}- Atualiza um departamento cadastrado conforme Id informado, para isso deve receber um Json com as informações que deseja atualizar.

Todos métodos Delete
- DELETE http://localhost:8081/person/{id}- Remove o cadastro da pessoa de acordo com o Id informado.

- DELETE http://localhost:8081/department/{id}- Remove o cadastro do departamento de acordo com o Id informado. 


## Validações
•	Os CPFS informados devem ser válidos. 
•	Data de nascimento deve ser válida (não é aceito data futura).
•	Para realizar o método Delete de um cadastro de Pessoa são realizadas algumas validações: 
o	Se a pessoa está cadastrada como pai ou mãe de algum outro cadastro, o cadastro do filho devera ser alterado ou removido para assim o método ser realizado com sucesso.
o	Se a pessoa está cadastrada como responsável de algum departamento, esse cadastro deve ser alterado e assim o método de remover o cadastro pode ser realizado corretamente. 

(Para estas condições realizamos buscas no banco de dados através do DAO para verificar e validar as informações);






