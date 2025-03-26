<!DOCTYPE html>
<html lang="en" data-x="html" data-x-toggle="html-overflow-hidden">
<head>
  <!-- Meta Charset -->
  <meta charset="UTF-8" />

  <!-- Required Meta Tags -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="{{!empty($meta_description) && $meta_description != '' ? $meta_description : 'PMS'}}" />
  <meta name="keywords" content="{{!empty($focus_keywords) && $focus_keywords != '' ? $focus_keywords : 'PMS'}}" />
  <meta name="author" content="Epartner Sri Lanka" />

  <!-- Favicons -->
  <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::to('assets/front/img/logo.png') }}" />
  <link rel="icon" type="image/png" sizes="32x32" href="{{ URL::to('assets/front/img/logo.png') }}" />
  <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/front/img/logo.png') }}" />

  <!-- Open Graph Meta Tags -->
  <meta property="og:title" content="{{!empty($meta_title) && $meta_title != '' ? $meta_title : 'PMS'}}" />
  <meta property="og:description" content="{{!empty($meta_description) && $meta_description != '' ? $meta_description : 'PMS'}}" />
  <meta property="og:type" content="website" />
  <meta property="og:url" content="https://www.pms.lk/" />
  <meta property="og:image" content="https://www.pms.lk/images/preview.jpg" />

  <!-- Twitter Meta Tags -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="{{!empty($meta_title) && $meta_title != '' ? $meta_title : 'PMS'}}" />
  <meta name="twitter:description" content="{{!empty($meta_description) && $meta_description != '' ? $meta_description : 'PMS'}}" />
  <meta name="twitter:image" content="https://www.pms.lk/images/preview.jpg" />

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Jost:wght@400;500;600;700&display=swap" rel="stylesheet">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ URL::to('assets/front/css/vendors.css') }}">
  <link rel="stylesheet" href="{{ URL::to('assets/front/css/main.css') }}">
  <link rel="stylesheet" href="{{ URL::to('assets/admin/vendor/toaster/toastr.min.css') }}">

  <!-- Canonical URL -->
  <link rel="canonical" href="https://www.pms.lk/" />

  <!-- Title -->
  <title>{{!empty($meta_title) && $meta_title != '' ? $meta_title : 'PMS'}}</title>


</head>