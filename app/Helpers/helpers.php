<?php

use Skill\Services\DiasUteisService;
use Carbon\Carbon;

function diasUteis($todayIsLast = false, $first = null)
{
	$calcDias = new DiasUteisService();
	return $calcDias->calcDiasUteis($first ? $first: fistOfMonth(), $todayIsLast ? today(): lastOfMonth());
}


function calcAtraso(Carbon $date, bool $number = false)
{
	Carbon::setLocale('pt_BR');

	if($number){
		return $date->diffInDays(Carbon::now('America/Sao_Paulo'), false, true);
	}

	return $date->diffForHumans(Carbon::now('America/Sao_Paulo'), false, true);
}


function fistOfMonth()
{
	$dt = Carbon::now();
	return $dt->firstOfMonth()->toDateString();
}

function lastOfMonth()
{
	$dt = Carbon::now();
	return $dt->lastOfMonth()->toDateString();
}


function today()
{
	return Carbon::today('America/Sao_Paulo')->toDateString();
}


function toPercentual($value)
{
	return number_format($value *100,2,',','.')  . ' %';
}


function number($value, $decimals = 2)
{
	return number_format($value, $decimals,',','.')  . ' %';
}


function toDate($date)
{
	return Carbon::createFromFormat('Y-m-d H:i:s',$date,'America/Sao_Paulo')->format('d-m-Y');
}