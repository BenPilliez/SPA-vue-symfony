<?php
/**
 *
 * Description.
 *
 * @author        Lorenzo Perone
 * @copyright    2020 Lorenzo Perone & Yellowspace - Perone & Rose GbR <info@yellowspace.net>
 * @license        C O N F I D E N T I A L   C O N T E N T
 * @package
 * Date of Creation: 14.10.20
 *
 */
namespace App\Filter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\AbstractContextAwareFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Util\QueryNameGeneratorInterface;
use Doctrine\ORM\QueryBuilder;
class rateFilter extends AbstractContextAwareFilter
{
    protected $parameterName = 'rate';
    /**
     * {@inheritdoc}
     */
    public function apply(QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null, array $context = []) {
        if ( isset($context['filters']) && is_array($context['filters'])) {
            if(!empty($context['filters'][$this->parameterName])) {
                $rate = $context['filters'][$this->parameterName];
            }
            else {
                return;
            }
        }
        else {
            return;
        }
        $queryBuilder
            ->join('o.rates', 'r')
            ->andWhere($queryBuilder->expr()->gte($queryBuilder->expr()->quot('r.rate', 'r.nbRate'), $rate))
            ->setMaxResults(10);
    }
    public function getDescription(string $resourceClass): array {
        $longStory = 'Find by minimum rate and sort';
        $parameterName = 'rate';
        $description[$parameterName] = [
            'property' => $parameterName,
            'description' => $longStory,
            'type'     => 'string',
            'required' => false,
            'is_collection' => false,
            'swagger'  => [
                'description' => $longStory,
                'name' => $parameterName
            ],
            'openapi' => [
                'description' => $longStory,
                'name' => $parameterName
            ]
        ];
        return $description;
    }
    protected function filterProperty(string $property, $value, QueryBuilder $queryBuilder, QueryNameGeneratorInterface $queryNameGenerator, string $resourceClass, string $operationName = null) {
        // everything is done directly in apply...()
    }
}