<?php
namespace App\Http\Service\Search;

use App\Http\Service\Search\Pipes\SwitcherKeyboardPipe;
use App\Http\Service\Search\Pipes\TransliteratorPipe;
use Illuminate\Pipeline\Pipeline;

class SearchWordHandler
{

    private $pipes = [
        SwitcherKeyboardPipe::class,
        TransliteratorPipe::class
    ];

    /**
     * @param string $wordHandle
     * @return array
     */
    public function handle(string $wordHandle):array
    {
        return app(Pipeline::class)
            ->send($wordHandle) // Данные, которые мы хотим пропустить через обработчики
            ->through($this->pipes) // Коллекция обработчиков
            ->then(function () {
                return []; // Возвращаются данные, пройденные через цепочку
            });
    }
}
