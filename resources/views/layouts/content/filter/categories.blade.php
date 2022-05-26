<option value="{{$category->id}}" @if(!empty($category['child']) && $category['parent_id'] == 0) disabled style="" @endif >
    {{$marker}}{{$category->name1}}
</option>
@if (count($category['child']) > 0)
        @foreach($category['child'] as $child)
            @include('layouts.content.filter.categories', ["category"=>$child, 'marker' => trim($marker)."-- "])
        @endforeach
@endif