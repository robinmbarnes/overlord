!#/bin/bash
php app/console doctrine:generate:entities Overlord/Bundle/CoreBundle/Entity && php app/console doctrine:schema:update --force
