<h2>Cliente</h2>
<ul>
<li class="<?= $vd->getSottoPagina() == 'home' || $vd->getSottoPagina() == null ? 'current_page_item' : '' ?>"><a href="cliente">Home</a></li>
<li class="<?= $vd->getSottoPagina() == 'lista' ? 'current_page_item' : '' ?>"><a href="cliente/lista">Lista Film</a></li>
<li class="<?= $vd->getSottoPagina() == 'noleggi' ? 'current_page_item' : '' ?>"><a href="cliente/noleggi">Noleggi</a></li>
</ul>