<?php

namespace AndreGumieri\LaravelSqliteLegacy\Database\Schema;

use Illuminate\Database\Schema\SQLiteBuilder;

class SQLiteLegacyBuilder extends SQLiteBuilder
{
    public function getColumns($table)
    {
        $table = $this->connection->getTablePrefix().$table;

//        0 => {#1177
//        +"cid": 0
//        +"name": "id"
//        +"type": "INTEGER"
//        +"notnull": 1
//        +"dflt_value": null
//        +"pk": 1
//  }

//        0 => {#1177
//        +"name": "id"
//        +"type": "INTEGER"
//        +"nullable": 0
//        +"default": null
//        +"primary": 1
//        +"extra": 0
//  }
        //
        $selectFromWriteConnection = $this->connection->selectFromWriteConnection($this->grammar->compileColumns($table));

        // Adjustment
        foreach($selectFromWriteConnection as &$row) {
            $row->nullable = !$row->notnull;
            $row->default = $row->dflt_value;
            $row->primary = $row->pk;
            $row->extra = 0;

            unset($row->cid);
            unset($row->notnull);
            unset($row->dflt_value);
            unset($row->pk);
        }

        $processColumns = $this->connection->getPostProcessor()->processColumns(
            $selectFromWriteConnection,
            $this->connection->scalar($this->grammar->compileSqlCreateStatement($table))
        );

        return $processColumns;
    }
}