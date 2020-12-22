
                            <table >
                                   cellspacing="0" width="100%">
                                <thead >
                                <tr>
                                    <th>م</th>
                                    <th>الاسم</th>
                                    <th>البريد الاليكتروني</th>
                                    <th>التليفون</th>
                                    <th>الحاله</th>
                                </tr>
                                </thead>
                                <tbody>

                                @forelse($alladmins as $key=>$value)
                                    <tr>

                                        <td>{{$value->id}}</td>
                                        <td> {{$value-> name }} </td>
                                        <td> {{$value-> email }} </td>
                                        <td> {{$value-> phone }} </td>

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
