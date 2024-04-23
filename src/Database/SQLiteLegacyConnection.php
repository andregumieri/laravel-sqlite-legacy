<?php

namespace AndreGumieri\LaravelSqliteLegacy\Database;

use AndreGumieri\LaravelSqliteLegacy\Database\Query\Grammars\SQLiteLegacyGrammar as QueryGrammar;
use AndreGumieri\LaravelSqliteLegacy\Database\Schema\Grammars\SQLiteLegacyGrammar as SchemaGrammar;
use AndreGumieri\LaravelSqliteLegacy\Database\Schema\SQLiteLegacyBuilder;
use Illuminate\Database\SQLiteConnection;

class SQLiteLegacyConnection extends SQLiteConnection
{
    protected function getDefaultQueryGrammar()
    {
        ($grammar = new QueryGrammar())->setConnection($this);

        return $this->withTablePrefix($grammar);
    }

    protected function getDefaultSchemaGrammar()
    {
        ($grammar = new SchemaGrammar())->setConnection($this);

        return $this->withTablePrefix($grammar);
    }

    public function getSchemaBuilder()
    {
        if (is_null($this->schemaGrammar)) {
            $this->useDefaultSchemaGrammar();
        }

        return new SQLiteLegacyBuilder($this);
    }
}