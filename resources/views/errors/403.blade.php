@extends('errors::minimal')

@section('title', __('Forbidden'))
@section('title', 'Access Forbidden')
@section('code', '403')
@section('message', __("You don't have permission to access this resource"))
