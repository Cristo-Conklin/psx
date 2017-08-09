<?php

namespace PSX\Project\Tests\Api\Generator;

use PSX\Project\Tests\ApiTestCase;

class OpenAPITest extends ApiTestCase
{
    public function testGet()
    {
        $response = $this->sendRequest('http://127.0.0.1/generator/openapi/*/population/popo', 'GET');

        $body   = (string) $response->getBody();
        $expect = <<<'JSON'
{
    "openapi": "3.0.0",
    "info": {
        "title": "PSX",
        "version": "0"
    },
    "servers": [
        {
            "url": "http:\/\/127.0.0.1\/"
        }
    ],
    "paths": {
        "\/population\/popo": {
            "get": {
                "operationId": "doGet",
                "parameters": [
                    {
                        "name": "startIndex",
                        "in": "query",
                        "required": false,
                        "schema": {
                            "type": "integer"
                        }
                    },
                    {
                        "name": "count",
                        "in": "query",
                        "required": false,
                        "schema": {
                            "type": "integer"
                        }
                    }
                ],
                "responses": {
                    "200": {
                        "description": "Collection result",
                        "content": {
                            "application\/json": {
                                "schema": {
                                    "$ref": "#\/components\/schemas\/Collection"
                                }
                            }
                        }
                    }
                }
            },
            "post": {
                "operationId": "doPost",
                "requestBody": {
                    "content": {
                        "application\/json": {
                            "schema": {
                                "$ref": "#\/components\/schemas\/Entity"
                            }
                        }
                    }
                },
                "responses": {
                    "201": {
                        "description": "Operation message",
                        "content": {
                            "application\/json": {
                                "schema": {
                                    "$ref": "#\/components\/schemas\/Message"
                                }
                            }
                        }
                    }
                }
            },
            "parameters": []
        }
    },
    "components": {
        "schemas": {
            "Collection": {
                "type": "object",
                "title": "collection",
                "description": "Collection result",
                "properties": {
                    "totalResults": {
                        "type": "integer"
                    },
                    "entry": {
                        "type": "array",
                        "items": {
                            "$ref": "#\/components\/schemas\/Entity"
                        }
                    }
                },
                "class": "PSX\\Project\\Tests\\Model\\Collection"
            },
            "Entity": {
                "type": "object",
                "title": "entity",
                "description": "Represents an internet population entity",
                "properties": {
                    "id": {
                        "type": "integer",
                        "description": "Unique id for each entry"
                    },
                    "place": {
                        "type": "integer",
                        "description": "Position in the top list",
                        "minimum": 1,
                        "maximum": 64
                    },
                    "region": {
                        "type": "string",
                        "description": "Name of the region",
                        "pattern": "[A-z]+",
                        "minLength": 3,
                        "maxLength": 64
                    },
                    "population": {
                        "type": "integer",
                        "description": "Complete number of population"
                    },
                    "users": {
                        "type": "integer",
                        "description": "Number of internet users"
                    },
                    "worldUsers": {
                        "type": "number",
                        "description": "Percentage users of the world"
                    },
                    "datetime": {
                        "type": "string",
                        "description": "Date when the entity was created",
                        "format": "date-time"
                    }
                },
                "required": [
                    "place",
                    "region",
                    "population",
                    "users",
                    "worldUsers"
                ],
                "class": "PSX\\Project\\Tests\\Model\\Entity"
            },
            "Message": {
                "type": "object",
                "title": "message",
                "description": "Operation message",
                "properties": {
                    "success": {
                        "type": "boolean"
                    },
                    "message": {
                        "type": "string"
                    }
                },
                "class": "PSX\\Project\\Tests\\Model\\Message"
            }
        }
    }
}
JSON;

        $this->assertEquals(null, $response->getStatusCode(), $body);
        $this->assertJsonStringEqualsJsonString($expect, $body, $body);
    }
}
