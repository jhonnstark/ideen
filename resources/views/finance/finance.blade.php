@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-between">
            <h1>Dashboard</h1>
            <hr class="col-12">
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center gap-10">
            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 100.75 100.748" style="enable-background:new 0 0 100.75 100.748;" xml:space="preserve"><g><path d="M17.313,56.946c0-0.803-0.65-1.453-1.453-1.453s-1.453,0.65-1.453,1.453c0,4.053,3.59,7.411,8.252,7.996v6.205c0,0.803,0.65,1.453,1.453,1.453s1.453-0.65,1.453-1.453V64.94c4.656-0.592,8.238-3.946,8.238-7.993
		c0-4.045-3.583-7.395-8.238-7.986V38.614c3.045,0.51,5.332,2.585,5.332,5.064c0,0.803,0.65,1.453,1.453,1.453s1.453-0.65,1.453-1.453c0-4.049-3.583-7.403-8.238-7.992v-6.213c0-0.803-0.65-1.453-1.453-1.453s-1.453,0.65-1.453,1.453v6.213
		c-4.663,0.588-8.252,3.942-8.252,7.992c0,4.046,3.589,7.399,8.252,7.985v10.352C19.607,61.507,17.313,59.429,17.313,56.946z
		 M30.897,56.946c0,2.477-2.287,4.552-5.332,5.065V51.888C28.61,52.4,30.897,54.472,30.897,56.946z M17.313,43.678
		c0-2.479,2.293-4.555,5.346-5.064v10.122C19.606,48.227,17.313,46.154,17.313,43.678z"/><path d="M96.51,20.412H3.492c-0.803,0-1.453,0.65-1.453,1.453v59.19c0,0.803,0.65,1.453,1.453,1.453H96.51
		c0.803,0,1.453-0.65,1.453-1.453v-59.19C97.963,21.062,97.312,20.412,96.51,20.412z M95.057,79.602H4.945V23.318h90.111V79.602z"/><path d="M45.77,40.236h42.282c0.803,0,1.453-0.65,1.453-1.453s-0.65-1.453-1.453-1.453H45.77c-0.803,0-1.453,0.65-1.453,1.453
		S44.967,40.236,45.77,40.236z"/><path d="M45.77,51.762h42.282c0.803,0,1.453-0.65,1.453-1.453c0-0.803-0.65-1.453-1.453-1.453H45.77
		c-0.803,0-1.453,0.65-1.453,1.453C44.317,51.111,44.967,51.762,45.77,51.762z"/><path d="M45.77,65.583h42.282c0.803,0,1.453-0.65,1.453-1.453s-0.65-1.453-1.453-1.453H45.77c-0.803,0-1.453,0.65-1.453,1.453
		S44.967,65.583,45.77,65.583z"/></g></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Pagos y recibos</h5>
                    <p class="card-text">Administración de pagos y creacion de recibos.</p>
                    <a href="{{ route('finance.payment.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="1792" height="1792" viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M63 1536h-63v-1408h63v1408zm63-1h-32v-1407h32v1407zm94 0h-31v-1407h31v1407zm157 0h-31v-1407h31v1407zm157 0h-62v-1407h62v1407zm126 0h-31v-1407h31v1407zm63 0h-31v-1407h31v1407zm63 0h-31v-1407h31v1407zm157 0h-63v-1407h63v1407zm157 0h-63v-1407h63v1407zm126 0h-63v-1407h63v1407zm126 0h-63v-1407h63v1407zm94 0h-63v-1407h63v1407zm189 0h-94v-1407h94v1407zm63 0h-32v-1407h32v1407zm94 1h-63v-1408h63v1408z"/></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Conceptos de pagos extras</h5>
                    <p class="card-text">Administración de pagos y creacion de conceptos.</p>
                    <a href="{{ route('finance.concept.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>

            <div class="card card-image col-sm">
                <div class="card-icon">
                    <svg width="2048" height="1792" viewBox="0 0 2048 1792" xmlns="http://www.w3.org/2000/svg"><path d="M1024 512h-384v384h384v-384zm128 640v128h-640v-128h640zm0-768v640h-640v-640h640zm640 768v128h-512v-128h512zm0-256v128h-512v-128h512zm0-256v128h-512v-128h512zm0-256v128h-512v-128h512zm-1536 960v-960h-128v960q0 26 19 45t45 19 45-19 19-45zm1664 0v-1088h-1536v1088q0 33-11 64h1483q26 0 45-19t19-45zm128-1216v1216q0 80-56 136t-136 56h-1664q-80 0-136-56t-56-136v-1088h256v-128h1792z"/></svg>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Reportes de cobranza</h5>
                    <p class="card-text">Generación de reportes.</p>
                    <a href="{{ route('finance.reports.list') }}" class="btn btn-primary">Entrar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
