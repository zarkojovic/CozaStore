<div class="table-responsive text-nowrap">
    <table class="table">
        <thead>
        <tr>
            @foreach($columns as $c)
                <th>{{$c}}</th>
            @endforeach
            <th>Edit</th>
            @if($allowDelete)
                <th>Delete</th>
            @endif
        </tr>
        </thead>
        <tbody class="table-border-bottom-0">
        @foreach($items as $i)
            <tr>
                @foreach($columns as $c)
                    @if($c =='avatar')
                        <td><img src="{{asset('assets/images/'.$i->$c)}}" alt="avatar"
                                 class="avatar avatar-sm me-2"></td>
                        @continue
                    @endif

                    @if(strlen($i->$c) > 20 && $c != 'log_message')
                        <td>{{substr($i->$c,0,20).'...'}}</td>
                        @continue
                    @else
                        <td>{{$i->$c}}</td>
                    @endif
                @endforeach
                <td>
                    <a href="{{route($routeBaseName.'.edit',$i->id)}}"
                       class="btn btn-icon btn-icon-only btn-outline-primary">
                        <i class="bx bx-edit bx-xs"></i>
                    </a>
                </td>
                @if($allowDelete)
                    <td>
                        <form action="{{route($routeBaseName.'.destroy',$i->id)}}" method="post" class="deletingForm">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-icon btn-icon-only btn-outline-danger">
                                <i class="bx bx-trash bx-xs"></i>
                            </button>
                        </form>
                    </td>
                @endif
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$items->links()}}
</div>
