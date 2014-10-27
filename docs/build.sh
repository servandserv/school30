#!/bin/sh
set -e
#  подчищаем
trap 'unlink temp.xml' EXIT
DOMAIN_XSLT="stylesheets/glossary/xml2domain.xsl";
USECASE_XSLT="stylesheets/glossary/xml2usecase.xsl";
GENERATED="generated"

# все глоссарии проекта
echo "<?xml version='1.0' encoding='utf-8'?><glo:glossary ID='glossary' xlink:title='Глоссарий' xmlns:glo='urn:ru:battleship:meta:glossary:glossary' xmlns:xlink='http://www.w3.org/1999/xlink'>" > temp.xml
find glossary -type f | while read j; do
#for j in glossary/*.xml; do
	echo "<glo:glossary xlink:type='locator' xlink:href='${j}' />" >> temp.xml
done
echo "</glo:glossary>" >> temp.xml

# собираем все термины предметных областей проекта
xsltproc stylesheets/glossary/gloss2docs.xsl temp.xml > glossary.xml

# делаем готовый файл документации для удобства просмотра
#xsltproc stylesheets/glossary/glossary.xsl glossary.xml > glossary.xhtml
#  строим диаграммы доменной области
find glossary -type f | while read j; do
	pack="${j%.xml}"
	pack="${GENERATED}/${pack#glossary/}"
	#echo "${pack}"

	mkdir -p graphviz/$pack/
	chmod 777 graphviz/$pack
	mkdir -p images/$pack/
	chmod 777 images/$pack
	xsltproc ${DOMAIN_XSLT} $j > graphviz/$pack/domain.dot
	dot -Tsvg -oimages/$pack/domain.svg graphviz/$pack/domain.dot
	chmod 777 images/$pack/domain.svg
done

#  сводная диаграмма предметной области
xsltproc ${DOMAIN_XSLT} glossary.xml > graphviz/${GENERATED}/domain.dot
dot -Tsvg -oimages/${GENERATED}/domain.svg graphviz/${GENERATED}/domain.dot
#chmod 777 images/domain.svg

# все пакеты сценариев проекта
echo "<?xml version='1.0' encoding='utf-8'?><ucpackage ID='ucpackage' xlink:title='Прецеденты использования' xmlns='urn:ru:battleship:meta:glossary:ucpackage' xmlns:xlink='http://www.w3.org/1999/xlink'>" > temp.xml
find ucpackage -type f | while read j; do
#for j in ucpackage/*.xml; do
	echo "<ucpackage xlink:type='locator' xlink:href='${j}' />" >> temp.xml
done
echo "</ucpackage>" >> temp.xml

# собираем вcе прецеденты проекта
xsltproc stylesheets/glossary/ucpackage2docs.xsl temp.xml > ucpackage.xml
chmod 777 ucpackage.xml
# делаем готовый файл документации для удобства просмотра
#xsltproc stylesheets/glossary/ucpackage.xsl ucpackage.xml > ucpackage.xhtml

# строим все диаграммы прецедентов
find ucpackage -type f | while read j; do
	pack="${j%.xml}"
	pack="${GENERATED}/${pack#ucpackage/}"
	#echo "${pack}"

	mkdir -p graphviz/$pack/
	#chmod 777 graphviz/$pack
	mkdir -p images/$pack/
	#chmod 777 images/$pack
	xsltproc ${USECASE_XSLT} $j > graphviz/$pack/ucpackage.dot
	dot -Tsvg -oimages/$pack/ucpackage.svg graphviz/$pack/ucpackage.dot
	#chmod 777 images/$pack/ucpackage.svg
done

# все пакеты интерфейсов проекта
echo "<?xml version='1.0' encoding='utf-8'?><interface ID='interface' xlink:title='Интерфейсы' xmlns='urn:ru:battleship:meta:glossary:interface' xmlns:xlink='http://www.w3.org/1999/xlink'>" > temp.xml
find interface -type f | while read j; do
#for j in interface/*.xml; do
	echo "<interface xlink:type='locator' xlink:href='${j}' />" >> temp.xml
done
echo "</interface>" >> temp.xml

# собираем вcе прецеденты проекта
xsltproc stylesheets/glossary/interface2docs.xsl temp.xml > interface.xml
chmod 777 interface.xml
# делаем готовый файл документации для удобства просмотра
#xsltproc stylesheets/glossary/interface.xsl interface.xml > interface.xhtml

# собираем всю документацию проекта в TOC
xsltproc stylesheets/glossary/docs2toc.xsl empty.xml > TOC.xml
