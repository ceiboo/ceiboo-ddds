Feature: Crear un nuevo Usuario
  Para tener usuarios en la plataforma
  Como usuario con permisos root
  Quiero crear un nuevo usuario

  Scenario: Un usuario válido no existente
    Given I send a PUT request to "/users/0faac746-309c-42f1-b6f0-5baf95816c22" with body:
    """
    {
      "company_id": "1",
      "name": "Jose Luis Alfaro",
      "role": "admin",
      "email": "joseluis@ceiboo.com",
      "status": "1"
    }
    """
    Then the response status code should be 201
    And the response should be empty
