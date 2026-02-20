@props([
    'name' => '',
    'id' => '',
    'titleTask' => '',
])

<div class="task">
    <div class="titleTaskAndInput">
        <input class="inputTask" type="checkbox" name="{{$name}}" id="{{$id}}">
        {{$titleTask}}
    </div>
    <button class="buttonHeadeColuna"><i class="bi bi-pencil-square"></i></button>
</div>