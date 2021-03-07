<template>
    <google-map-loader
        :mapConfig="mapConfig"
        :apiKey="apiKey"
        :style="styles">
        <template slot-scope="{ google, map }">
            <google-map-marker
                v-for="marker in markers"
                :key="marker.id"
                :marker="marker"
                :google="google"
                :map="map"
            />
            <google-map-line
                v-for="line in lines"
                :key="line.id"
                :path.sync="line.path"
                :google="google"
                :map="map"
            />
        </template>
    </google-map-loader>
</template>

<script>
import GoogleMapLoader from './../maps/google-map-loader.component';
import GoogleMapMarker from './../maps/google-map-marker.component';
import GoogleMapLine from './../maps/google-map-line.component';

export default {
    name: "google-map.component",
    components: {
        GoogleMapLoader,
        GoogleMapMarker,
        GoogleMapLine,
    },
    // props: ['markers', 'lines', 'config', 'style'],
    props: {
        markers: Array,
        lines: Array,
        config: Object,
        style: Object,
    },
    data() {
        return {
            configs: {
                ...this.$props.config,
                zoom: _.get(this.$props.config, 'zoom', 20),
                center: _.get(this.$props.config, 'position', {let: 0, lng: 0}),
            },
            styles: this.$props.style || { height: '500px', width: '100%', overflow: 'hidden !important' }
        }
    },
    mounted() {
        console.log(this.mapMarkers, this.mapConfig);
    },
    computed: {
        apiKey() {
            return 'AIzaSyDtML-Aqf_jzSjvmI719z8OKabwtrWaW9Y';
        },
        mapConfig () {
            return {
                ...this.configs
            }
        },
        mapMarkers() {
            if (!this.markers) {
                return [
                    {
                        id: '1',
                        position: this.configs.center
                    }
                ];
            }
        }
    }
}
</script>

<style scoped>

</style>