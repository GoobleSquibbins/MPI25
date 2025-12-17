
import http from 'k6/http';
import { check, sleep } from 'k6';
import { BASE_URL } from './config.js';

export const options = {
    vus: 1,
    duration: '1m',
    thresholds: {
        http_req_failed: ['rate<0.01'], 
        http_req_duration: ['p(95)<200'], 
    },
};

export default function () {
    const res = http.get(BASE_URL);
    check(res, {
        'is status 200': (r) => r.status === 200,
        'homepage has expected content': (r) => r.body.includes('welcome'),
    });
    sleep(1);
}
