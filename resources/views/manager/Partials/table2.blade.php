

<div style="max-height: 545px; overflow-y: auto; margin: 40px;">
    <table class="table  table-striped table-fixed" style="height: 60px ">
      <thead style="position: sticky;
      top: 0;
      background-color: #fff; /* Add your preferred background color */
      z-index: 1;">
          <tr>
              <th>#</th>
              <th>Index Number</th>
              <th>Subject1</th>
              <th>Subject2</th>
              <th>Subject3</th>
              <th>Subject4</th>
              <th>Subject5</th>
              <th>Subject6</th>
              <th>Rank</th>
          </tr>
      </thead>
      <tbody class="overflow">
          @php
              $serialNumber = 1; // Initialize the serial number
          @endphp
          @foreach($data as $item)
              <tr>
                  <td>{{$serialNumber++}}</td>
                  <td>{{ $item->index_number }}</td>
                
                @if(isset($item->mat))
                    <td>MAT: {{ $item->mat }}</td>
                @else
                    <td>BMT: {{ $item->bmt}}</td>
                @endif
                
                @if(isset($item->eng))
                    <td>ENG: {{ $item->eng }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->dzo))
                    <td>DZO: {{ $item->dzo }}</td>
                @else
                    <td>-</td>
                @endif
                @if(isset($item->acc))
                    <td>ACC: {{ $item->acc }}</td>
                @else
                <td>-</td>
        @endif
        @if(isset($item->phy))
            <td>PHY: {{ $item->phy }}</td>
        @else
            <td></td>
        @endif
        @if(isset($item->bio))
            <td>BIO: {{ $item->bio }}</td>
        @else
            <td></td>
        @endif
        @if(isset($item->che))
            <td>CHE: {{ $item->che }}</td>
        @else
            <td></td>
        @endif
                  <td>{{ $item->rankSIDD }}</td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  