@if(isset($data['numberAllocations']) && !empty($data['numberAllocations']) && count($data['numberAllocations']) > 0)
    <table>
        <tr>
            <th>NXX</th>
            <th>Company</th>
            <th>Service</th>
            <th>Notes</th>
        </tr>
        @foreach($data['numberAllocations'] as $numberAllocation)
            <tr>
                <td>{{$numberAllocation->nxx}}</td>
                <td>{{$numberAllocation->blogsCat->varTitle}}</td>
                <td>{{$numberAllocation->service}}</td>
                <td>{{$numberAllocation->note}}</td>
            </tr>
        @endforeach
    </table>
@endif