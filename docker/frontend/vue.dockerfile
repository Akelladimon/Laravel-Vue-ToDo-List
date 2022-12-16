FROM node:17 as dev-stage

RUN mkdir /usr/src/app && mkdir /usr/src/app/frontend

WORKDIR /usr/src/app/frontend

COPY ../../frontend/package*.json ./

RUN npm install

COPY . .

CMD [ "npm", "run", "serve"]

# FROM node:16 as build-stage
# WORKDIR /app
# COPY package*.json ./
# RUN npm install
# COPY ./ .
# RUN npm run build

# FROM nginx as production-stage
# EXPOSE 3000
# RUN mkdir /app
# COPY nginx.conf /etc/nginx/conf.d/default.conf
# COPY --from=build-stage /app/dist /app
