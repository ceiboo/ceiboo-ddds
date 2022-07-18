Feature: Api status
  Quiero conocer que el servidor esta arriba y en ejecución
  Quiero chequear el estado de mi api

  Scenario: Chequeando el api
    Given I send a GET request to "/status"
    Then the response content should be:
    """
    {
      "core-api": "ok",
      "rand": 1
    }
    """
