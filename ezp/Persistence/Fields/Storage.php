<?php
/**
 * File containing the Storage interface
 *
 * @copyright Copyright (C) 1999-2011 eZ Systems AS. All rights reserved.
 * @license http://www.gnu.org/licenses/gpl-2.0.txt GNU General Public License v2
 * @version //autogentag//
 *
 */

namespace ezp\Persistence\Fields;
use ezp\Persistence\Content\Field;

/**
 * Interface for setting field type data.
 *
 * Methods in this interface are called by storage engine.
 *
 * $context array passed to most methods provides some context for the field handler about the
 * currently used storage engine.
 * The array should at least define 2 keys :
 *   - identifier (connection identifier)
 *   - connection (the connection handler)
 * For example, using Legacy storage engine, $context will be:
 *   - identifier = 'LegacyStorage'
 *   - connection = {@link \ezp\Persistence\Storage\Legacy\EzcDbHandler} object handler (for DB connection),
 *                  to be used accordingly to
 *                  {@link http://incubator.apache.org/zetacomponents/documentation/trunk/Database/tutorial.html ezcDatabase} usage
 */
interface Storage
{
    /**
     * Allows custom field types to store data in an external source (e.g. another DB table).
     *
     * Stores value for $field in an external data source.
     * The whole {@link ezp\Persistence\Content\Field} ValueObject is passed and its value
     * is accessible through the {@link ezp\Persistence\Content\FieldValue} 'value' property.
     * This value holds the data filled by the user as a {@link ezp\Content\FieldType\Value} based object,
     * according to the field type (e.g. for TextLine, it will be a {@link ezp\Content\FieldType\TextLine\Value} object).
     *
     * $field->id = unique ID from the attribute tables (needs to be generated by
     * database back end on create, before the external data source may be
     * called from storing).
     *
     * The context array provides some context for the field handler about the
     * currently used storage engine.
     * The array should at least define 2 keys :
     *   - identifier (connection identifier)
     *   - connection (the connection handler)
     * For example, using Legacy storage engine, $context will be:
     *   - identifier = 'LegacyStorage'
     *   - connection = {@link \ezp\Persistence\Storage\Legacy\EzcDbHandler} object handler (for DB connection),
     *                  to be used accordingly to
     * The context array provides some context for the field handler about the
     * currently used storage engine.
     * The array should at least define 2 keys :
     *   - identifier (connection identifier)
     *   - connection (the connection handler)
     * For example, using Legacy storage engine, $context will be:
     *   - identifier = 'LegacyStorage'
     *   - connection = {@link \ezp\Persistence\Storage\Legacy\EzcDbHandler} object handler (for DB connection),
     *                  to be used accordingly to
     *                  {@link http://incubator.apache.org/zetacomponents/documentation/trunk/Database/tutorial.html ezcDatabase} usage
     *
     * @param \ezp\Persistence\Content\Field $field
     * @param array $context
     * @return void
     */
    public function storeFieldData( Field $field, array $context );

    /**
     * Populates $field value property based on the external data.
     * $field->value is a {@link ezp\Persistence\Content\FieldValue} object.
     * This value holds the data as a {@link ezp\Content\FieldType\Value} based object,
     * according to the field type (e.g. for TextLine, it will be a {@link ezp\Content\FieldType\TextLine\Value} object).
     *
     * @param \ezp\Persistence\Content\Field $field
     * @param array $context
     * @return void
     */
    public function getFieldData( Field $field, array $context );

    /**
     * @param array $fieldId Array of field Ids
     * @param array $context
     * @return bool
     */
    public function deleteFieldData( array $fieldId, array $context );

    /**
     * Checks if field type has external data to deal with
     *
     * @return bool
     */
    public function hasFieldData();

    /**
     * @param \ezp\Persistence\Content\Field $field
     * @param array $context
     */
    public function copyFieldData( Field $field, array $context );

    /**
     * @param \ezp\Persistence\Content\Field $field
     * @param array $context
     */
    public function getIndexData( Field $field, array $context );
}
