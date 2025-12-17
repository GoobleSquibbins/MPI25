
import http from 'k6/http';
import { check, sleep } from 'k6';
import { BASE_URL } from './config.js';

export const options = {
    stages: [
        { duration: '2m', target: 20 }, // Normal load
        { duration: '1m', target: 800 }, // Spike
        { duration: '3m', target: 800 }, // Hold spike
        { duration: '1m', target: 20 }, // Ramp down
        { duration: '2m', target: 20 }, // Recovery
    ],
    thresholds: {
        http_req_failed: ['rate<0.1'], // Higher threshold for spike
        http_req_duration: ['p(95)<1500'],
    },
};

export default function () {
    const res = http.get(BASE_URL);
    check(res, { 'status is 200': (r) => r.status === 200 });
    sleep(1);
}
