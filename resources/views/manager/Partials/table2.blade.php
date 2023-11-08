

<div style="max-height: 545px; overflow-y: auto; margin: 40px; max-width:95%">
    <table class="table  table-striped table-fixed" style="height: 60px ">
      <thead style="position: sticky;
      top: 0;
      background-color: #fff; /* Add your preferred background color */
      z-index: 1;">
          <tr>
              <th>#</th>
              <th>Index Number</th>
              <th>ENG</th>
              <th>DZO</th>
              <th>COM</th>
              <th>ACC</th>
              <th>BMT</th>
              <th>GEO</th>
              <th>HIS</th>
              <th>ECO</th>
              <th>MED</th>
              <th>BENT</th>
              <th>EVS</th>
              <th>RIGE</th>
              <th>AGFS</th>
              <th>MAT</th>
              <th>PHY</th>
              <th>CHE</th>
              <th>BIO</th>
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
                @if(isset($item->eng))
                    <td>{{ $item->eng }}</td>
                @else
                    <td>-</td>
                @endif
                
                @if(isset($item->dzo))
                    <td>{{ $item->dzo}}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->com))
                    <td>{{ $item->com}}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->acc))
                    <td>{{ $item->acc }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->bmt))
                    <td>{{ $item->bmt}}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->geo))
                    <td>{{ $item->geo }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->his))
                    <td>{{ $item->his }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->eco))
                    <td>{{ $item->eco }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->med))
                    <td>{{ $item->med }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->bent))
                    <td>{{ $item->bent }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->evs))
                    <td>{{ $item->evs }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->rige))
                    <td>{{ $item->rige }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->agfs))
                    <td>{{ $item->agfs }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->mat))
                    <td>{{ $item->mat }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->phy))
                    <td>{{ $item->phy }}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->che))
                    <td>{{ $item->che}}</td>
                @else
                    <td>-</td>
                @endif

                @if(isset($item->bio))
                    <td>{{ $item->bio }}</td>
                @else
                    <td>-</td>
                @endif
                  <td>{{ $item->rankSIDD }}</td>
              </tr>
          @endforeach
      </tbody>
    </table>
  </div>
  