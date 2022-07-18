Feature: Crear una nueva Empresa
  Para tener empresas en la plataforma
  Como usuario con permisos admin o root
  Quiero crear una nueva empresa

  Scenario: Una empresa válida no existente
    Given I send a PUT request to "/companies/0faac746-309c-42f1-b6f0-5baf95816c22" with body:
    """
    {
      "name": "Ceiboo",
      "address": "Avenida Parque Sarmiento 500",
      "country": "Argentina",
      "status": "1"
    }
    """
    Then the response status code should be 201
    And the response should be empty
