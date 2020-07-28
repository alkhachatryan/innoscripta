<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Schema;

class InTableColumnsRule implements Rule
{
    /**
     * The name of the table.
     *
     * @var string
    */
    private $tableName;

    /**
     * Create a new rule instance.
     *
     * @param string $tableName
     * @return void
     */
    public function __construct($tableName)
    {
        $this->tableName = $tableName;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $columns = Schema::getColumnListing($this->tableName);

        return in_array($value, $columns);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Wrong sortable column';
    }
}
