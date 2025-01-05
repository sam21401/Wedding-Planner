<style>
.article_section .box {
    position: relative;
    margin-top: 25px;
    padding: 25px;
    background-color: #f7f8f9;
    transition: all .3s;
    overflow: hidden;
    box-shadow: 2px 2px 8px rgba(0,0,0,.1);
    border: solid #fff 5px;
    border-radius: 8px; /* Dodane zaokrąglenie */
}

.article_section .detail-box {
    text-align: left;
    padding: 10px;
}

.article_section .detail-box h5 {
  
    margin-top: 10px;
    font-weight: bold;
}

.article_section .detail-box .article-description {
    color: #666;
    font-size: 1.1em;
    line-height: 1.4;
}

.article_section .read-more {
    display: inline-block;
    padding: 5px 10px;
    background-color: #176505;
    color: #ffffff;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s;
}

.article_section .read-more:hover {
    background-color: #0f4303;
}

</style>
<section class="article_section layout_padding">
    <div class="container">
        <div class="heading_container heading_center">
            <h2>
                Artykuły i <span>komunikaty</span>
            </h2>
        </div>
        <div class="row">
            @foreach($article as $articles)
            <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="box">
                  
                   
                    <div class="detail-box">
                        <h5 style="margin-top: 10px;">
                            {{$articles->title}}
                        </h5>
                        <p class="article-description" style="margin-top: 10px; color: #333;">
                            {{ Str::limit($articles->description, 150, '...') }}
                        </p>
                        
						<h6 style="color: gray; font-size: 0.9em;">
         Autor: {{$articles->author ?? 'Nieznany'}} 
| Data utworzenia: {{ \Carbon\Carbon::parse($articles->created_at)->format('d.m.Y') }}, godz. {{ \Carbon\Carbon::parse($articles->created_at)->format('H:i') }} 
| Ostatnia aktualizacja: {{ \Carbon\Carbon::parse($articles->updated_at)->format('d.m.Y') }}, godz. {{ \Carbon\Carbon::parse($articles->updated_at)->format('H:i') }}


                        </h6>
                        <a href="{{url('aktualnosci_detale', $articles->id)}}" class="read-more" style="display: inline-block; padding: 5px 10px; background-color: #176505; color: #fff; border-radius: 5px; text-decoration: none; margin-top: 10px;">
						
                            Czytaj więcej
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div style="padding-top:20px; text-align: center;">
            {!! $article->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</section>
