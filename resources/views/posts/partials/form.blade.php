<div>
    Title<input type="text" name="title" value="{{old('title',optional($post ?? null)->title)}}">
</div>
@error('title')
{{$message}}
@enderror
<div> Content<textarea name="content" cols="30" rows="10">{{old('content',optional($post ?? null)->content)}}</textarea></div>
@error('content')
{{$message}}
@enderror
