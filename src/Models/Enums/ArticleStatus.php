<?php

 declare(strict_types=1);

namespace Abr4xas\SimpleBlog\Models\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self DRAFT()
 * @method static self PUBLISHED()
 */

 class ArticleStatus extends Enum
 {
     /**
      * @return string
      */
     public function label(): string
     {
         return match ($this->value) {
             self::DRAFT()->value => 'DRAFT',
             self::PUBLISHED()->value => 'PUBLISHED',
         };
     }

     /**
      * @return string
      */
     public function color(): string
     {
         return match ($this->value) {
             self::DRAFT()->value => 'bg-red-500',
             self::PUBLISHED()->value => 'bg-green-500',
         };
     }
 }
