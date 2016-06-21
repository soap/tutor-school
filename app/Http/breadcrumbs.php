<?php

Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('home'));
});

Breadcrumbs::register('students.index', function ($breadcrumbs) {
    $breadcrumbs->push('Students', route('students.index'));
});

Breadcrumbs::register('students.show', function($breadcrumbs, $student)
{
    $breadcrumbs->parent('students.index');
    $breadcrumbs->push('View Student', route('students.show', $student));
});
Breadcrumbs::register('students.create', function ($breadcrumbs) {
    $breadcrumbs->parent('students.index');
    $breadcrumbs->push('New Student', route('students.create'));
});
