<x-app-layout >

    <div class="mainContainer col-12 border border-red">
    
        <div class="containerColuna">

            <!-- // header; -->
             <div class="headerColuna">
                cabecalho do quadro
             </div>
            
            <div class="task">
                minha task A
            </div>
        
            <div class="task">
                minha task B
            </div>

            <!-- footer -->
            <div class="footerColuna">
                footer do quadro
            </div>
        
        </div>
    
        <div class="containerColuna">
            
            <!-- // header; -->
            <div class="headerColuna">
            cabecalho do quadro
            </div>

            <div class="task">
                minha task BA
            </div>
        
            <!-- footer -->
            <div class="footerColuna">
                footer do quadro
            </div>

        </div>
    
        <div class="containerColuna">
            
            <div class="footerColuna">
                + Adicionar outra lista
            </div>

        </div>
    
    </div>

</x-app-layout>
@vite('resources/css/dashboard.css')