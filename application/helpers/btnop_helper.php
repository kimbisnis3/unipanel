<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
function btnud($text)
{
    $text = ("<button type='button' class='btn btn-sm btn-warning ' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='fa fa-edit'></i></button>
    	<button type='button' class='btn btn-sm btn-danger ' data-toggle='tooltip' data-placement='top' title='Hapus' onclick='hapus_data(".$text.")'><i class='fa fa-trash'></i></button>");
 
    return $text;
}

function btnuda($text)
{
    $text = ("
    	<button type='button' class='btn btn-sm btn-warning ' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='fa fa-edit'></i></button>
    	<button type='button' class='btn btn-sm btn-danger ' data-placement='top' title='Hapus' onclick='hapus_data(".$text.")'><i class='fa fa-trash'></i></button>
    	<button type='button' class='btn btn-sm btn-success ' data-placement='top' title='Aktif' onclick='aktif_data(".$text.")'><i class='fa fa-check'></i></button>
    	");
 
    return $text;
}

function btnu($text)
{
    $text = ("<button type='button' class='btn btn-sm btn-warning ' data-toggle='tooltip' data-placement='top' title='Edit' onclick='edit_data(".$text.")'><i class='fa fa-edit'></i></button>");
 
    return $text;
}
 
?>