@forelse ($files as $file)
<img src="{{ $message->embed($file) }}">
{{ $file }}
<br />
<hr />
@empty
No images found
@endforelse