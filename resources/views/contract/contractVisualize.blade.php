<?php
/**
 * Author : Quentin Neves
 * Created : 12.12.2017
 * Updated : 09.01.2018
 */
?>
@extends ('layout')

@section ('content')
    <h1>View contract</h1>

    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script>tinymce.init({ selector:'textarea' });</script>

    <form method="post" action="/contract/{{$iid}}/">
        <textarea name="contractText">{{$contract->contracttext}}</textarea>
        <button>Envoie la sauce negro</button> <!-- TO DELETE -->
    </form>


@stop