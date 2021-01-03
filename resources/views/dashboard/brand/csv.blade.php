
                            <table >
                                   cellspacing="0" width="100%">
                                <thead >
                                <tr>
                                    <th>م</th>
                                    <th>الاسم</th>
{{--                                    <th>الاسم بالرابط</th>--}}
                                    <th>الحاله</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($allbrands as $key=>$value)
                                    <tr>

                                        <td>{{$value->id}}</td>
                                        <td>{{$value->translate('ar')-> name }} - {{$value->translate('en')-> name }} </td>
                                        <td>{{$value->translate('en')-> name }} </td>
{{--                                        <td>{{$value->slug}}</td>--}}
                                        <td>
                                                <span data-id="{{$value->id}}" title="update Status" data-target="on"
                                                      class="status on ">{{$value->getActive()}}</span>
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="">لا يوجد بيانات</td>
                                    </tr>
                                @endforelse





                                </tbody>
                            </table>
