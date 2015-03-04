<?php

namespace Csv\Collection;

use Csv\Column\AssertableColumn;

/**
 * @method AssertableColumn getColumn($name)
 */
class AssertableColumnCollection extends ColumnCollection
{
    public function sameValueAs(NamedWritableColumnCollection $columns)
    {
        if (parent::sameValueAs($columns) and $columns instanceof self) {
            /** @var AssertableColumn $column */
            foreach ($columns as $column) {
                if (!is_a($column->getAssertion(), get_class($this->getColumn($column->getName())->getAssertion()))) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }
}
