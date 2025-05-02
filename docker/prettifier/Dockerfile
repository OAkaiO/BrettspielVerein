FROM homebrew/brew:latest@sha256:3fced0852919e6edad58ce4c96216abc1113e6d172c524f27860c7232e6ec223

RUN brew install htmlq
RUN brew install npm
RUN npm install -g prettier

COPY --chown=1000:1000 prettify.sh /opt/prettify.sh

WORKDIR /opt
ENTRYPOINT [ "./prettify.sh" ]