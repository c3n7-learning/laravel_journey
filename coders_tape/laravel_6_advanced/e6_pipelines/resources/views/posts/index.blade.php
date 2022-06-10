<table>
  @foreach ($posts as $post)
    <tr>
      <td>
        {{ $post->active }} </td>
      <td>
        {{ $post->title }} </td>
    </tr>
  @endforeach
</table>

{{ $posts->appends(request()->input())->links() }}
