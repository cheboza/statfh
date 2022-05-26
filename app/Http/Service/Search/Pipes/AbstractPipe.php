<?php

namespace App\Http\Service\Search\Pipes;

use App\Http\Service\Search\Traits\StemWordRecipient;
use Closure;

abstract class AbstractPipe
{
    use StemWordRecipient;

    /**
     * @param string $wordHandle
     * @param Closure $next
     * @return array|mixed
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(string $wordHandle, Closure $next) {
        return $this->getKeysByStemWord($this->switching($wordHandle)) ?? $next($wordHandle);
    }

    abstract protected function switching(string $wordHandle):?string;
}
