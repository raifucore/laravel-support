<?php

namespace RaifuCore\Support\Enums;

use RaifuCore\Support\Traits\EnumTrait;

enum VariableTypeEnum: string
{
    use EnumTrait;

    case BOOL = 'BOOL';
    case STRING = 'STRING';
    case TEXT = 'TEXT';
    case INT = 'INT';
    case FLOAT = 'FLOAT';
    case ARRAY = 'ARRAY';
    case JSON = 'JSON';
    case DATE = 'DATE';
    case DATETIME = 'DATETIME';
    case TIME = 'TIME';
    case TIMESTAMP = 'TIMESTAMP';
    case UUID = 'UUID';
}
