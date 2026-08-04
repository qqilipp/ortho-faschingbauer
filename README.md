# Ortho Faschingbauer – Website

Quellcode für die Website von Prof. DDr. Martin Faschingbauer (Orthopädie & Endoprothetik, Wien): [ortho-faschingbauer.at](https://ortho-faschingbauer.at)

## Stack

- WordPress (Custom-Theme, kein Page Builder)
- Advanced Custom Fields Pro
- WPML
- WS Form
- Hosting: GridPane / Hetzner

## Inhalt dieses Repos

- `wp-content/themes/marfas24` – Custom-Theme (ursprünglich von Designtiger Webdesign, seit 2026 von KOSMAS betreut)
- `wp-content/plugins/faschingbauer-medical-schema` – Custom-Plugin für medizinisches Schema-Markup (JSON-LD)

Lizenzierte Drittanbieter-Plugins (ACF Pro, WPML, WS Form Pro etc.) sowie Uploads/Medien sind bewusst **nicht** Teil dieses Repos.

## Deployment

Push auf `main` deployt `wp-content/themes/marfas24` und `wp-content/plugins/faschingbauer-medical-schema` automatisch auf den Live-Server (GitHub Actions, `.github/workflows/deploy.yml`).

- Verbindung läuft über einen eigenen, auf diese Site beschränkten SSH-Deploy-Key (System-User `ortho-fasch11843`, **kein** Root-Zugriff)
- Ablauf: neue Ordner hochladen → alten Ordner umbenennen → neuen an dessen Stelle setzen → alten löschen (kein Moment mit fehlenden Dateien)
- Secrets (`DEPLOY_SSH_KEY`, `DEPLOY_HOST`, `DEPLOY_USER`, `DEPLOY_PATH`) liegen in den Repo-Settings unter *Secrets and variables → Actions*

## Betreuung

KOSMAS Healthcare Marketing (kosmas.at)
