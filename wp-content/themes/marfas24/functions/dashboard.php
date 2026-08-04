<?php

// Widgets entfernen
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_activity']);
}

// Eigenes Widget anzeigen
add_action( 'wp_dashboard_setup', 'register_welcome_dashboard_widget' );
function register_welcome_dashboard_widget() {
	add_meta_box(
		'welcome_dashboard_widget',
		'Hinweise zur Bedienung Ihrer Website',
		'welcome_dashboard_widget_display',
		'dashboard', 'side', 'high'
	);
}

function welcome_dashboard_widget_display() { 
?>

<style>

	#dashboard-widgets .inside .activity-block h4 {
		margin-top: 10px !important;
	}

</style>
	
	<p>Guten Tag, und herzlich willkommen im Verwaltungsbereich Ihrer Website. Hier sind einige kurze Informationen, die Sie bei der Bedienung des Content Management Systems unterstützen sollen.</p>
    
    <div class="activity-block">
    
	    <h4><strong>Häufig genutzte Funktionen</strong></h4>
	    <ul>
			<?php if( ! function_exists( 'tigris_remove_posts' ) ) { ?>
			<li>&bull; <a href='<?php echo admin_url("post-new.php") ?>'>Neuen News-Beitrag erstellen</a></li>
			<?php } ?>
			<?php if ( post_type_exists( 'produkte' ) ) {?>
			<li>&bull; <a href='<?php echo admin_url("post-new.php?post_type=produkte") ?>'>Neues Produkt anlegen</a></li>
			<?php } ?>
			<?php if ( post_type_exists( 'termine' ) ) {?>
			<li>&bull; <a href='<?php echo admin_url("post-new.php?post_type=termine") ?>'>Neuen Termin anlegen</a></li>
			<?php } ?>
			<li>&bull; <a href='<?php echo admin_url("edit.php?post_type=page") ?>'>Bestehende Seite bearbeiten</a></li>
			<li>&bull; <a href='<?php echo admin_url("profile.php") ?>'>Ihr Benutzerprofil</a></li>
	    </ul>
	    
    </div>
	
	<div class="activity-block">
	
		<h4><strong>Suchmaschinenoptimierung</strong></h4>
		<p>Beim Erstellen neuer Seiten, News-Beiträge etc. achten Sie bitte darauf, am Ende der Seite unter <em><strong>SEO Informationen</strong></em> auch die Felder <em>"SEO Titel"</em> und <em>"SEO Beschreibung"</em> auszufüllen, diese sind sehr wichtig für die Suchmaschinen.</p>

	</div>
	
	<div class="activity-block">
	
		<h4><strong>Bilder</strong></h4>
		<p>Beim Hochladen von Bildern oder PDF-Dokumenten achten Sie bitte darauf, einen "<em><a title="Mehr Informationen zur Verwendung von Bildern auf Ihrer Website" target="_blank" href="https://www.designtiger.at/webdesign-grafik-infos/sprechende-dateinamen-seo/">sprechenden Dateinamen</a></em>" ohne Sonderzeichen zu verwenden sowie nach dem Upload der Datei einen passenden <em><a title="Mehr Informationen zur Verwendung von Bildern auf Ihrer Website" target="_blank" href="https://www.designtiger.at/webdesign-grafik-infos/sprechende-dateinamen-seo/">Alternativtext (ALT-Text)</a></em> zuzuweisen. Das hilft den Suchmaschinen dabei, auch die Bilder Ihrer Website besser zu indizieren. </p>
		
	</div>
	
	<div class="activity-block">
	
		<h4><strong>Backups</strong></h4>
		<?php if ( is_plugin_active( 'backupwordpress/backupwordpress.php' ) || is_plugin_active( 'updraftplus/updraftplus.php' ) ) { ?>
		<p>Das Backup-Paket für Ihre Website ist aktiviert.</p>
		
		<ul>
			<?php if ( is_plugin_active( 'backupwordpress/backupwordpress.php' ) ) { ?>
			<li>&bull; <a href='<?php echo admin_url("tools.php?page=backupwordpress") ?>'>Backups verwalten</a></li>
			<?php } ?>
			<?php if ( is_plugin_active( 'updraftplus/updraftplus.php' ) ) { ?>
			<li>&bull; <a href='<?php echo admin_url("options-general.php?page=updraftplus") ?>'>Backups verwalten</a></li>
			<?php } ?>
		</ul>
		<?php } else { ?>
		<p>Falls Sie noch kein Backup-Paket gebucht haben, können Sie dieses <a target="_blank" href="https://www.designtiger.at/bestellung/backup/" title="Backup-Paket bestellen">hier</a> bestellen. Gerne informieren wir Sie auch persönlich über die Möglichkeiten zur laufenden, automatischen Sicherung Ihrer Website.</p>
		<?php } ?>	
	
	</div>
	
	<div class="activity-block">
	
		<h4><strong>Plugins und Erweiterungen</strong></h4>
	    
	    <p>Wenn Sie zusätzliche Plugins verwenden möchten, teilen Sie uns das bitte vorher mit, damit wir das Theme Ihrer Website dafür vorbereiten und gegebenenfalls das Design und die Funktionalitäten anpassen können.</p>
	    
	    <p>Falls Sie sich eine funktionelle Erweiterung Ihrer Website wünschen, beispielsweise um einen Terminkalender, Blog, Mehrsprachigkeit oder ähnliches, kontaktieren Sie uns bitte, damit wir die Details besprechen können. </p>

	</div>
	
	<div class="activity-block">
	
		<h4><strong>Kontakt: Service & Support</strong></h4>
		<p>&nbsp; <br />
			<img width="180" src="<?php echo get_stylesheet_directory_uri(); ?>/images/designtiger.png"/>
		</p>	
		<p>Gerne stehen wir Ihnen im Rahmen Ihres Service-Pakets bei Fragen und für die Optimierung sowie Änderungen und Erweiterungen Ihrer Website zur Verfügung: </p>
		<ul>
			<li>&bull; <a target="_blank" href="https://www.designtiger.at/kontakt" title="Kontakt">Kontakt: Designtiger</a></li>
		</ul>

	</div>

<?php } ?>