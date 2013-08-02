silex-restapi
=============

Api desenvolvida de estudo do micro-framework silex.

### Rotas
#### GET
* /cervejas - Retorna um json com todas as servejas cadastradas.
* /cervejas/{id} - Retorna informações sobre uma cerveja especifica.
* /cervejas/{id}/{info} - Retorna alguma informação da cerveja, (Nome, estilo, etc);

* /estilos - Retorna todos os estilos de cervejas.
#### PUT
* /cervejas/{id}/nome/{novoNome} - Modifica o nome de uma cerveja existente.
* /cervejas/{id}/estilo/{novoEstilo} - Modifica o estilo de uma cerveja existente.
#### DELETE
* /cervejas/{id} - Deleta uma cerveja em específico.
#### Continua...
