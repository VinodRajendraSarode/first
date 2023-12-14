<?php

$config = [
	'prevActive' => '<li class="page-item"><a class="page-link" href="{{url}}" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>',
	'prevDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}" aria-label="Previous"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>',
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
	'nextActive' => '<li class="page-item"><a class="page-link" href="{{url}}" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Previous</span></a></li>',
	'nextDisabled' => '<li class="page-item disabled"><a class="page-link" href="{{url}}" aria-label="Next"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="#">{{text}}<span class="sr-only">(current)</span></a></li>',
    
    'sort' => '<a class="sort" href="{{url}}">{{text}}</a>',
    'sortAsc' => '<a class="sort" href="{{url}}">{{text}} &#x25B2;</a>',
    'sortDesc' => '<a class="sort" href="{{url}}">{{text}} &#x25BC;</a>',    
];
