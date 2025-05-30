{{-- Template untuk rendering satu node dalam hierarki --}}
<div class="hierarchy-node">
    <div class="employee-box"
        data-role="{{ $node['pegawai'] ? ($node['pegawai']->jenis_pegawai ? $node['pegawai']->jenis_pegawai->name : '') : 'Department' }}">
        <div class="employee-name">
            {{ $node['pegawai'] ? $node['pegawai']->nama : $node['jabatan']->name }}
        </div>
        <div class="employee-position">
            {{ $node['jabatan']->name }}
        </div>
        @if ($node['pegawai'] && $node['pegawai']->jenis_pegawai)
            <div class="employee-role">
                {{ $node['pegawai']->jenis_pegawai->name ?? 'Tidak ada jenis' }}
            </div>
        @endif
    </div>

    @if (count($node['children']) > 0)
        <div class="connector"></div>
        <div class="children-connector">
            <div class="horizontal-line"
                style="width: {{ count($node['children']) * 210 - 30 }}px; left: {{ -((count($node['children']) * 210 - 30) / 2) }}px;">
            </div>
            @foreach ($node['children'] as $child)
                <div class="vertical-line"></div>
            @endforeach
        </div>

        <div class="children-container">
            @foreach ($node['children'] as $child)
                @include('pages.partials.hierarcy-node', ['node' => $child, 'level' => $level + 1])
            @endforeach
        </div>
    @endif
</div>
