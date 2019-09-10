@extends ('layout')

@section ('content')
    <h2 class="text-left">Stage de {{ $iship->studentfirstname }} {{ $iship->studentlastname }} chez {{ $iship->companyName }}</h2>
    <form action="/internships/{{$iship->id}}/update" method="get">
    <table class="table text-left larastable">
        <tr>
            <td class="col-md-2">Du</td>
            <td>
                <input type="date" name="beginDate" value="{{ strftime("%G-%m-%d", strtotime($iship->beginDate)) }}" required/>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">Au</td>
            <td>
                <input type="date" name="endDate" value="{{ strftime("%G-%m-%d", strtotime($iship->endDate)) }}" required/>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">Description</td>
            <td>
                <div id="description">{!! $iship->internshipDescription !!}</div>
                <script>
                    BalloonEditor
                        .create( document.querySelector( '#description' ) )
                        .then( editor => {
                            console.log( editor );
                        } )
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                <textarea style="display: none" name="description" id="txtDescription"></textarea>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">Responsable administratif</td>
            <td>
                <select name="aresp">
                    @foreach($resp->get()->toArray() as $value)
                        <option value="{{ $value->id }}" @if ($iship->arespid == $value->id) selected @endif>{{$value->firstname}} {{$value->lastname}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">Responsable</td>
            <td>
                <select name="intresp">
                    @foreach($resp->get()->toArray() as $value)
                        <option value="{{ $value->id }}" @if ($iship->intrespid == $value->id) selected @endif>{{$value->firstname}} {{$value->lastname}}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">Maître de classe</td>
            <td>{{ $iship->initials }}</td>
        </tr>
        <tr>
            <td class="col-md-2">Etat</td>
            <td>
                <select name="stateDescription">
                    @foreach($states->get()->toArray() as $value)
                        <option value="{{ $value->id }}" @if ($iship->contractstate_id == $value->id) selected @endif>{{ $value->state }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
        <tr>
            <td class="col-md-2">Salaire</td>
            <td><input type="number" name="grossSalary" value="{{$iship->grossSalary}}"/></td>
        </tr>
        @if (isset($iship->previous_id))
            <tr>
                <td class="col-md-2" colspan="3"><a href="/internships/{{ $iship->previous_id }}/edit">Stage précédent</a></td>
            </tr>
        @endif
    </table>
        {{-- Action buttons --}}
        <a href="/internships/{{$iship->id}}/view">
            <button class="btn btn-danger" type="button">Annuler les modifications</button>
        </a>
        <button class="formSend btn btn-warning" type="submit" onclick="transferDiv();">Valider les modifications</button>
        <script type="text/javascript">
            function transferDiv(){
                var divHtml = document.getElementById("description");
                var txtHtml = document.getElementById("txtDescription");
                txtHtml.value = divHtml.innerHTML;
            }
        </script>
    </form>
    @if (isset($visits))
        <hr/>
        <form id="visitsForm" action="/internships/{{$iship->id}}/updateVisit" method="get">
        <table class="table text-left larastable">
            <tr>
                <th colspan="5">Visites</th>
            </tr>
            <tr>
                <td>Date et heure</td>
                <td>Etat</td>
                <td>N°</td>
                <td colspan="2">Note</td>
            </tr>
            <tr id="addVisit">
                <td colspan="5">
                    <button class="btn btn-primary" type="button" onclick="visits();">Ajouter une visite</button>
                    <script type="text/javascript">
                        function visits(){
                            var tr = document.getElementById("addVisit");
                            tr.innerHTML = "<td><input name='visitDate' type='date' value='{{ date("Y-m-d") }}' required/><input name='visitTime' type='time' value='{{ date("H:i") }}' required/></td><td><select name='visitState'><option value='0' selected>Non-confirmé</option><option value='1'>Confirmé</option></select></td><td><input name='visitNumber' type='number' required/></td><td><input name='grade' type='number' min='1' max='6' step='0.5'/></td><td><button class='btn btn-warning' onclick='addVisits();' type='submit'>Valider la visite</button></td>";
                        }
                    </script>
                </td>
            </tr>
            <script type="text/javascript">
                function addVisits(){
                    var form = document.getElementById("visitsForm");
                    form.setAttribute("action", "/internships/{{$iship->id}}/addVisit");
                }
            </script>
            @foreach ($visits->toArray() as $row=>$value)
                <tr>
                    <input name="visitID{{ $row }}" type="hidden" value="{{ $value->id }}" />
                    <td>
                        <input name="visitDate{{ $row }}" type="date" value="{{ strftime("%G-%m-%d", strtotime($value->moment)) }}" required />
                        <input name="visitTime{{ $row }}" type="time" value="{{ strftime("%H:%M", strtotime($value->moment)) }}" required />
                    </td>
                    <td>
                        <select name='visitState{{ $row }}'>
                            <option value='0' {{ $value->confirmed == 0 ? "selected" : "" }}>Non-confirmé</option>
                            <option value='1' {{ $value->confirmed == 1 ? "selected" : "" }}>Confirmé</option>
                        </select>
                    </td>
                    <td>
                        <input name='visitNumber{{ $row }}' type='number' value="{{ $value->number }}" required/>
                    </td>
                    <td colspan="2">
                        <input name='grade{{ $row }}' type='number' min='1' max='6' step='0.5' value="{{ $value->grade }}"/>
                    </td>
                </tr>
            @endforeach
        </table>
            <button class="btn btn-warning" type="submit" >Valider toutes les visites</button>
        </form>
    @endif
    @if (isset($remarks))
        <hr/>
        <form action="/internships/{{$iship->id}}/addRemark" method="get">
        <table class="table text-left larastable">
            <tr>
                <th colspan="4">Remarques</th>
            </tr>
            <tr>
                <td>Date</td>
                <td>Auteur</td>
                <td colspan="2">Remarque</td>
            </tr>
            <tr id="addRemark">
                <td colspan="4">
                    <button class="btn btn-primary" type="button" onclick="remarks();">Ajouter une remarque</button>
                    <script type="text/javascript">
                        function remarks(){
                            var tr = document.getElementById("addRemark");
                            tr.innerHTML = "<td><input name='remarkDate' type='date' value='{{ date("Y-m-d") }}' readonly required/></td><td><input name='remarkAuthor' type='text' value='{{ env("USER_INITIALS") }}' readonly required/></td><td><textarea name='remark' required cols='100'></textarea></td><td><button class='btn btn-warning' type='submit'>Valider la remarque</button></td>";
                        }
                    </script>
                </td>
            </tr>
            @foreach ($remarks->toArray() as $value)
                <tr>
                    <td>
                        {{ strftime("%e %b %g", strtotime($value->remarkDate)) }}
                    </td>
                    <td>
                        {{ $value->author }}
                    </td>
                    <td colspan="2">
                        {{ $value->remarkText }}
                    </td>
                </tr>
            @endforeach
        </table>
        </form>
    @endif
@stop