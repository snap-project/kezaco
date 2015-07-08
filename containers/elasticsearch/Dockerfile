FROM elasticsearch:latest

ENV proxy_port=3128
ENV proxy_host=192.168.10.254

RUN /usr/share/elasticsearch/bin/plugin -DproxyPort=${proxy_port} -DproxyHost=${proxy_host} install polyfractal/elasticsearch-inquisitor &&\
    /usr/share/elasticsearch/bin/plugin -DproxyPort=${proxy_port} -DproxyHost=${proxy_host} install elasticsearch/elasticsearch-mapper-attachments/2.6.0
