<?php

namespace BVZ;

use BVZ\Event;
use Aura\Sql\ExtendedPdo;
use Aura\SqlQuery\QueryFactory;

class EventRepository
{    
    public function getNextThreeEvents()
    {
        $queryBuilder = new QueryFactory('mysql', QueryFactory::COMMON);
        $select = $queryBuilder->newSelect()
        ->cols(['e.id', 'e.date', 'e.start_time', 'e.location', 'et.name', 'et.price'])
        ->from('event AS e')
        ->innerJoin('event_type AS et', 'e.event_type = et.id')
        ->where('e.date > :current_date')
        ->bindValue('current_date',date('Y-m-d'))
        ->limit(3);

        return $this->getConnection()->fetchObjects($select->getStatement(), $select->getBindValues(), Event::class);
    }

    private function getConnection()
    {
        return new ExtendedPdo(
            'mysql:host=brettspielverein_db_1;dbname=bv_zofingen',
            'root',
            'example',
            [], // driver attributes/options as key-value pairs
            []  // queries to execute after connection
        );
    }
}