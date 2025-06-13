{
    'name': '{{$node['jabatan']->name}}',
    'title': '{{$node['pegawai'] ? $node['pegawai']->nama : $node['jabatan']->name}}',
    className:'{{ str_replace(' ', '', $node['pegawai']->jenis_pegawai->name ?? 'none')  }}',
    @if(count($node['children']) > 0)
    'children': [
        @foreach ($node['children'] as $child)
        @include('pages.partials.hierarchy-data', ['node' => $child]),
        @endforeach
    ]
    @endif  
}