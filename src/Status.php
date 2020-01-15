<?php

namespace Easyutil\Utilities;

class Status
{
    /** const SUCCESS constante responsável pela resposta de Sucesso nas requisições */
    const SUCCESS = 00;

    /** const UNAUTHORIZED constante responsável pela resposta de Inautorizado nas requisições */
    const ERROR = 01;

    /** const ERROR_VALIDATION constante responsável pela resposta de Erro nas Validações das requisições */
    const ERROR_VALIDATION = 02;

    /** const API_SUCCESS constante responsável pela resposta de Sucesso nas requisições */
    const API_SUCCESS = 200;

    /** @var string CREATED constante para identificar sucesso/criado */
    const API_CREATED = 201;

    /** const ERROR_VALIDATION constante responsável pela resposta de Erro nas Validações das requisições */
    const API_ERROR_VALIDATION = 400;

    /** const UNAUTHORIZED constante responsável pela resposta de Inautorizado nas requisições */
    const UNAUTHORIZED = 401;

    /** const NOT_FOUND constante responsável pela resposta de Inexistente nas requisições */
    const NOT_FOUND = 404;

    /** @var string CONFLICT constante para identificar conflito de parâmetros */
    const CONFLICT = 409;

    /** @var string UNPROCESSABLE_ENTITY constante para identificar falha na validação */
    const UNPROCESSABLE_ENTITY = 422;

    /** const INTERNAL_ERROR constante responsável pela resposta de Erro Interno das requisições */
    const INTERNAL_ERROR = 500;
}
